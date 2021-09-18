import { shallowMount } from "@vue/test-utils";
import UserCard from "@/Components/UserCard";

const defaultProps = {
    user: { name: "TEST_USER" },
    created_at: "TEST_CREATED_AT",
};
const factory = (props = defaultProps) => {
    return shallowMount(UserCard, {
        props: { ...props },
    });
};

describe("UserCard.vue", () => {
    it("renders correctly", () => {
        const wrapper = factory();
        expect(wrapper.html()).toMatchSnapshot();
    });

    it("contains author anchor tag", () => {
        const wrapper = factory();
        expect(wrapper.get("a").text()).toMatch(defaultProps.user.name);
    });

    it("contains post timestamp", () => {
        const wrapper = factory();
        expect(wrapper.text()).toContain(defaultProps.created_at);
    });
});
