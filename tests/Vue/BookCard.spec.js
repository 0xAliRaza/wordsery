import { shallowMount } from "@vue/test-utils";
import BookCard from "@/Components/BookCard";
import book from "./book.json";


const factory = async (props = { book }) => {
    return await shallowMount(BookCard, {
        props: { ...props },
    });
};

test("renders correctly", () => {
    const wrapper = factory();
    expect(wrapper.html()).toMatchSnapshot();
});

test("contains title", () => {
    const wrapper = factory();
    expect(wrapper.html()).toContain(book.volumeInfo.title);
});

test("contains authors", () => {
    const wrapper = factory();
    for (let i = 0; i < book.volumeInfo.authors.length; i++) {
        const author = book.volumeInfo.authors[i];
        expect(wrapper.html()).toContain(author);
    }
});

test("renders thumbnail", () => {
    const wrapper = factory();
    expect(wrapper.find("img").exists());
});

const alteredBook = book;
alteredBook.volumeInfo.imageLinks.smallThumbnail = undefined;
test("does not render thumbnail", () => {
    const wrapper = factory({ book: alteredBook });
    expect(wrapper.find("img").exists()).toBeFalsy();
});
