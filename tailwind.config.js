/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

export const content = ["./app/Views/*.php", "./app/Views/**/*.php", "./app/Views/**/**/*.php", "./public/*.js", "./node_modules/flowbite/**/*.js"];
export const theme = {
  extend: {}
};
export const plugins = [require('@tailwindcss/forms'), require('@tailwindcss/aspect-ratio'), require('flowbite/plugin')];

