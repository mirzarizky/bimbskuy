module.exports = {
    root: true,
    parserOptions: {
        parser: "babel-eslint",
        ecmaVersion: 2016,
        sourceType: 'module'
    },
    plugins: [
      'vue'
    ],
    env: {
        browser: true,
    },
    extends: [
        "eslint:recommended",
        "plugin:vue/recommended"
    ],
    rules: {
        'generator-star-spacing': 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off'
    }
}