//https://splidejs.com/image-slider/

document.addEventListener("DOMContentLoaded", function () {
  new Splide("#splide", {
    pagination: true,
    grid: {
      rows: 3,
      cols: 3,
      gap: {
        row: "1.5rem",
        col: "1.5rem",
      },
    },
    breakpoints: {
      1200: {
        grid: false,
        pagination: false,
        autoWidth: true,
        focus: "center",


      },
      480: {
        grid: false,
        pagination: false,
        autoWidth: false,
        focus: "center",

        padding: {
          right: "5rem",
          left: "5rem",
        },
      },
    },
  }).mount(window.splide.Extensions);
});
