<template>
  <k-dialog
    ref="dialog"
    class="k-picker-dialog"
    v-bind="$props"
    @close="$emit('close')"
    @cancel="$emit('cancel')"
    @submit="submit"
  >
    <template v-if="items.length">
      <k-input
        v-if="search"
        v-model="query"
        :autofocus="true"
        :placeholder="$t('search') + ' …'"
        type="text"
        class="k-dialog-search"
        icon="search"
      />

      <k-items
        :link="false"
        :items="items"
        :sortable="false"
        layout="list"
        @item="toggle"
      >
        <template #options="{ item: file }">
          <k-button v-bind="toggleBtn(file)" @click="toggle(file)" />
        </template>
      </k-items>

      <k-pagination
        :details="true"
        :dropdown="false"
        v-bind="pagination"
        class="k-dialog-pagination"
        align="center"
        @paginate="paginate"
      />
    </template>
    <k-empty v-else icon="image">
      {{ empty || $t("dialog.files.empty") }}
    </k-empty>
  </k-dialog>
</template>

<script>
import DialogMixin from "@/mixins/dialog.js";

export default {
  mixins: [DialogMixin],
  props: {
    empty: String,
    items: {
      type: Array
    },
    limit: {
      type: Number,
      default: 20
    },
    max: {
      type: Number
    },
    multiple: {
      type: Boolean,
      default: true
    },
    search: {
      type: Boolean,
      default: true
    },
    selected: {
      type: Array
    },
    size: {
      type: String,
      default: "medium"
    },
    submitButton: {
      type: [String, Boolean],
      default() {
        return window.panel.$t("save");
      }
    },
    theme: {
      type: String,
      default: "positive"
    }
  },
  data() {
    return {
      pagination: {
        page: 1,
        limit: this.limit
      },
      selection: this.selected,
      query: null
    };
  },
  watch: {
    selected() {
      this.selection = this.selected;
    }
  },
  computed: {
    checkedIcon() {
      return this.multiple === true ? "check" : "circle-filled";
    }
  },
  methods: {
    isSelected(item) {
      return this.selection.includes(item.id);
    },
    paginate(pagination) {},
    submit() {
      this.$emit("submit", this.selection);
      // this.close();
    },
    toggle(item) {
      if (this.multiple === false) {
        this.selection = [];
      }

      if (this.isSelected(item)) {
        this.selection = this.selection.filter((id) => id !== item.id);
        return;
      }

      if (this.max && this.max <= this.selection.length) {
        return;
      }

      this.selection.push(item.id);
    },
    toggleBtn(item) {
      const isSelected = this.isSelected(item);

      return {
        autofocus: true,
        icon: isSelected ? this.checkedIcon : "circle-outline",
        tooltip: isSelected ? this.$t("remove") : this.$t("select"),
        theme: isSelected ? "positive" : null
      };
    }
  }
};
</script>

<style>
.k-picker-dialog .k-list-item {
  cursor: pointer;
}
</style>
