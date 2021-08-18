const path = require("path");

module.exports = {
    resolve: {
        alias: {
            "@": path.resolve("resources/js"),
            "@scss": path.resolve("resources/scss"),
        },
    },
};
