module.exports = {
    testRegex: "tests/Vue/.*.spec.js$",
    moduleFileExtensions: ["js", "vue"],
    moduleNameMapper: {
        "^@/(.*)$": "<rootDir>/resources/js/$1",
    },
    transform: {
        "^.+\\.js$": "<rootDir>/node_modules/babel-jest",
        ".*\\.vue$": "<rootDir>/node_modules/vue3-jest",
    },
    testEnvironment: "jsdom",
    snapshotSerializers: ["<rootDir>/node_modules/jest-serializer-vue"],
};
