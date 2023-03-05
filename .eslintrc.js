module.exports = {
    root: true,
    extends: [
      "eslint:recommended",
      "plugin:vue/vue3-recommended",
      "@vue/eslint-config-typescript/recommended"
    ],
    rules: {
      "no-redeclare": "off"
    }
  };
