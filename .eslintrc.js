module.exports = {
  root: true,
  parserOptions: {
    parser: "babel-eslint",
    ecmaVersion: 6,
    sourceType: "module",
  },
  plugins: ["vue"],
  env: {
    browser: true,
  },
  extends: ["eslint:recommended", "plugin:vue/recommended", "prettier"],
  rules: {
    "no-undef": "warn",
    "generator-star-spacing": "off",
    "no-debugger": process.env.NODE_ENV === "production" ? "error" : "off",
    "no-console": process.env.NODE_ENV === "production" ? "error" : "off",
    "vue/max-attributes-per-line": "off",
  },
};
