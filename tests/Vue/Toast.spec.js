const { mount, shallowMount } = require("@vue/test-utils");
import Toast from "@/Components/Toast";
import { describe } from "jest-circus";

const factory = (props) => {
    return shallowMount(Toast, {
        slots: {
            default: "Test message",
        },
        props: { ...props },
    });
};

describe("Toast.vue", () => {
    it("renders correctly", () => {
        const wrapper = factory();
        expect(wrapper.html()).toMatchSnapshot();
    });

    it("emits a closing event when clicked", async () => {
        const wrapper = factory();
        await wrapper.find("div").trigger("click.prevent");
        expect(wrapper.emitted().close).toBeTruthy();
    });

    it("emits a closing event after seven seconds", async () => {
        jest.useFakeTimers();
        const wrapper = factory();
        expect(wrapper.emitted().close).toBeFalsy();
        jest.advanceTimersByTime(7000);
        expect(wrapper.emitted().close).toBeTruthy();
    });
});
