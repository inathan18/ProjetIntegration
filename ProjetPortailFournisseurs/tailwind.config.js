/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./resources/**/*.css", // Optional: Include if using additional CSS files
  ],
  theme: {
      extend: {},
  },
  plugins: [],
};