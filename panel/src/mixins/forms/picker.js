import { props as Field } from "@/components/Forms/Field.vue";

export default {
  mixins: [Field],
  inheritAttrs: false,
  props: {
    empty: String,
    info: String,
    link: Boolean,
    /**
     * Switches the layout of the items
     * @values list, cards
     */
    layout: {
      type: String,
      default: "list"
    },
    max: Number,
    /**
     * If false, only a single item can be selected
     */
    multiple: Boolean,
    parent: String,
    search: Boolean,
    size: String,
    text: String,
    value: {
      type: Array,
      default() {
        return [];
      }
    }
  },
  data() {
    return {
      items: [],
      selected: this.value
    };
  },
  computed: {
    btnIcon() {
      if (!this.multiple && this.selected.length > 0) {
        return "refresh";
      }

      return "add";
    },
    btnLabel() {
      if (!this.multiple && this.selected.length > 0) {
        return this.$t("change");
      }

      return this.$t("add");
    },
    isInvalid() {
      if (this.required && this.selected.length === 0) {
        return true;
      }

      if (this.min && this.selected.length < this.min) {
        return true;
      }

      if (this.max && this.selected.length > this.max) {
        return true;
      }

      return false;
    },
    more() {
      if (!this.max) {
        return true;
      }

      return this.max > this.selected.length;
    }
  },
  watch: {
    value: {
      handler(value) {
        this.selected = value;
        this.load();
      },
      immediate: true
    }
  },
  methods: {
    focus() {},
    isSelected(item) {
      return this.selected.includes(item.id);
    },
    async load() {
      this.items = await this.$api.get(this.endpoints.field, {
        selected: this.selected
      });
    },
    onInput() {
      this.$emit("input", this.selected);
    },
    open() {
      if (this.disabled) {
        return false;
      }

      this.$refs.selector.open({
        endpoint: this.endpoints.field,
        max: this.max,
        multiple: this.multiple,
        search: this.search,
        selected: this.selected.map((model) => model.id)
      });
    },
    remove(index) {
      this.selected.splice(index, 1);
      this.onInput();
    },
    removeById(id) {
      this.selected = this.selected.filter((item) => item.id !== id);
      this.onInput();
    },
    select(selected) {
      this.selected = selected;
      this.onInput();
    }
  }
};
