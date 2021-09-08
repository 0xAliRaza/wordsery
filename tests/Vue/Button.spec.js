import Button from '@/Components/Button.vue'
import {mount} from '@vue/test-utils'
    test("renders correctly", () => {
        const wrapper = mount(Button);
        expect(wrapper.html()).toMatchSnapshot();
    });