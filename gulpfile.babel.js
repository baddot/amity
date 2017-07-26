import gulp from "gulp";
import uglify from "gulp-uglify";
import streamify from "gulp-streamify";
import concat from "gulp-concat";
import cleanCSS from "gulp-clean-css";
import babel from "gulp-babel";

const dirs = {
	outputJS: "./static/js",
	module: "./static/js/modules/admin.js",
	outputCSS: "./static/css",
	cssFiles: ["./static/css/*.css", "!./static/css/bundle.min.css"]
};

gulp.task("bundle", async () => {
    await gulp.src(["./static/js/libs/angular.min.js", "./static/js/libs/notyf.min.js", "./static/js/libs/jquery.min.js", "./static/js/libs/tether.min.js", "./static/js/libs/bootstrap.min.js", "./static/js/libs/moment.min.js", "./static/js/libs/moment-datepicker.js", "./static/js/libs/ru.js", "./static/js/libs/underscore.min.js"])
        .pipe(concat("bundle.min.js"))
        .pipe(uglify())
        .pipe(gulp.dest(`${dirs.outputJS}`));
});

gulp.task("babel", async () => {
    await gulp.src(`${dirs.module}`)
        .pipe(babel({
            presets: ["es2015"]
        }))
        .pipe(gulp.dest("./build"));
});


gulp.task("minify-css", async () => {
    await gulp.src(`${dirs.cssFiles}`)
        .pipe(cleanCSS({
            compatibility: "*"
        }))
        .pipe(concat("bundle.min.css"))
        .pipe(gulp.dest(`${dirs.outputCSS}`));
});

gulp.task("watch", () => {
    gulp.watch(`${dirs.cssFiles}`, ["minify-css"]);
});
