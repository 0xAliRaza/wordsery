import Button from '@/Components/Button.vue'
import {mount} from '@vue/test-utils'
describe("Button", () => {
    it("renders correctly", () => {
        const wrapper = mount(Button);
        expect(wrapper.html()).toMatchSnapshot();
    });
});