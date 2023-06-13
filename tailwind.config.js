/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors:{
        primary: '#727C4A',
        secondary: '#343C2D',
        orange: '#E39D36',
        lgray: '#F3F3F3',
        dgray: '#9E9E9E'
      },
      fontFamily: {
          sans: ['Poppins', 'sans-serif'],
      },
      fontSize: {
        title: '1.875rem',
        heading: '1.3125rem',
        subheading: '1.125rem',
        name: '1rem',
        subname: '0.875rem',
      },
      borderRadius: {
          'default': '5px',
      },
    },
  },
  plugins: [],
}

