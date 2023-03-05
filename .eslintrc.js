module.exports = {
    root: true,
    extends: [
      "eslint:recommended",
      "plugin:vue/vue3-recommended",
      "@vue/eslint-config-typescript/recommended"
    ],
    rules: {
      "no-redeclare": "off",
      "vue/multi-word-component-names": "off",
      "@typescript-eslint/no-empty-function":"off",
      "vue/no-v-html": 'off'
    },
    "globals": {
        "defineProps": "readonly",
        "defineEmits": "readonly",
        "defineExpose": "readonly",
        "withDefaults": "readonly",
        "axios": "readonly",
        "route": "readonly",
        "Ziggy": "readonly"
      }
  };
