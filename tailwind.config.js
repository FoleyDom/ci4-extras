/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

export const content = ["./app/Views/*.php", "./app/Views/**/*.php", "./app/Views/**/**/*.php", "./public/*.js"];
export const theme = {
  extend: {}
};
export const plugins = [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio')];

