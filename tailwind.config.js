module.exports = {
  content: ['**/*.php'],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    fontFamily: {
      'patrick': ['Patrick Hand', 'cursive']
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}

// npx tailwindcss -i assets/css/dev.css -o style.css -w 