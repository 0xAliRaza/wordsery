const { shallowMount, flushPromises, mount } = require("@vue/test-utils");
import book from "./book.json";
import * as axios from "axios";
import Post from "@/Components/Post";
const post = {
    content:
        "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.",
    book: "klj349sdfGLkjsdf_",
    id: 34,
    user: { name: "John Doe" },
};
jest.mock("axios");
axios.get.mockResolvedValue({ data: { ...book } });

const factory = (shallow = true, props = { post }) => {
    if (shallow) {
        return shallowMount(Post, {
            props: { ...props },
        });
    }
    return mount(Post, {
        props: { ...props },
    });
};
describe("Post.vue", () => {
    it("renders correctly", () => {
        const wrapper = factory();
        expect(wrapper.html()).toMatchSnapshot();
    });

    it("renders content", async () => {
        const wrapper = factory();
        expect(wrapper.text()).toContain(post.content);
    });

    // it("renders book card", async () => {
    //     const wrapper = factory(false);
    //     expect(axios.get).toHaveBeenCalledWith(
    //         `https://www.googleapis.com/books/v1/volumes/${post.book}`
    //     );
    //     await flushPromises();
    //     await nextTick();
    //     expect(wrapper.get("BookCard")).toBeTruthy();
    // });
    // it("does not render book card", async () => {
    //     const wrapper = factory(false);
    //     expect(axios.get).toHaveBeenCalledWith(
    //         `https://www.googleapis.com/books/v1/volumes/${post.book}`
    //     );
    //     await flushPromises();
    //     await nextTick();
    //     console.log(wrapper.html());
    //     expect(wrapper.get("BookCard")).toBeTruthy();
    // });
});
