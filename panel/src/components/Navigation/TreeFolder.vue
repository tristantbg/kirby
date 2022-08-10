<template>
  <details :open="isOpen" class="k-tree-folder">
    <summary :style="style" @click.prevent="toggle()">
      <span class="k-tree-folder-title">
        <k-icon type="folder" />
        <span class="k-tree-label">
          {{ label }}
        </span>
      </span>
    </summary>
    <k-tree :active="active" :children="children" :level="level + 1" />
  </details>
</template>

<script>
export default {
  props: {
    active: String,
    children: Array,
    level: Number,
    label: String,
    id: String,
  },
  computed: {
    storageId() {
      return "tree/" + this.id;
    },
    style() {
      return {
        paddingLeft: this.level * 0.75 + "rem",
      };
    },
  },
  mounted() {
    this.isOpen = localStorage.getItem(this.storageId);
  },
  data() {
    return {
      isOpen: false,
    };
  },
  methods: {
    toggle() {
      this.isOpen = !this.isOpen;

      if (this.isOpen) {
        localStorage.setItem(this.storageId, true);
      } else {
        localStorage.removeItem(this.storageId);
      }
    },
  },
};
</script>
