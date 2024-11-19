module.exports = {
  content: require('fast-glob').sync([
      './**/*.php'
  ]),
  theme: {
    container: {
    },
    extend: {
      fontFamily: {
        plus: ["Plus Jakarta Sans", "sans-serif"],
      },
    },
  },
  plugins: [
    function ({ addComponents }) {
        addComponents({
            '.container': {
                maxWidth: '100%',
                marginLeft: 'auto',
                marginRight: 'auto',
                paddingLeft: '1rem',
                paddingRight: '1rem',
                '@screen sm': {
                    maxWidth: '640px',
                },
                '@screen md': {
                    maxWidth: '100%',
                    paddingLeft: '1rem',
                    paddingRight: '1rem',
                },
                '@screen lg': {
                    maxWidth: '1024px',
                    paddingLeft: '0',
                    paddingRight: '0',
                },
                '@screen xl': {
                    maxWidth: '1210px',
                    paddingLeft: '0',
                    paddingRight: '0',
                },
            },
        });
    },
],
}