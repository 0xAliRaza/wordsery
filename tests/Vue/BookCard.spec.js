import { mount } from "@vue/test-utils";
import BookCard from "@/Components/BookCard";
import book from "./book.json";
const wrapper = mount(BookCard, { props: { book } });
const html = wrapper.html();

test("renders correctly", () => {
    expect(html).toMatchSnapshot();
});

test("contains title", () => {
    expect(html).toContain(book.volumeInfo.title);
});

test("contains authors", () => {
    for (let i = 0; i < book.volumeInfo.authors.length; i++) {
        const author = book.volumeInfo.authors[i];
        expect(html).toContain(author);
    }
});

test("renders thumbnail", () => {
    expect(wrapper.find("img").exists());
});

const alteredBook = book;
alteredBook.volumeInfo.imageLinks.smallThumbnail = undefined;
test("does not render thumbnail", () => {
    const wrapper = mount(BookCard, { props: { book: alteredBook } });
    expect(wrapper.find("img").exists()).toBeFalsy();
});
