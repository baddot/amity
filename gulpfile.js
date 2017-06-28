let gulp = require("gulp"),
    uglify = require("gulp-uglify"),
    streamify = require("gulp-streamify"),
    concat = require("gulp-concat"),
    cleanCSS = require("gulp-clean-css");


gulp.task("bundle", () => {
    return gulp.src("./static/js/libs/*.js")
        .pipe(concat("bundle.min.js"))
        .pipe(uglify())
        .pipe(gulp.dest("./static/js"))
});


gulp.task("minify-css", () => {
    return gulp.src(["./static/css/*.css", "!./static/css/bundle.min.css"])
        .pipe(cleanCSS({
            compatibility: "*"
        }))
        .pipe(concat("bundle.min.css"))
        .pipe(gulp.dest("./static/css"));
});