<template>
  <k-link
    :style="style"
    :data-active="active === id"
    :to="url"
    class="k-tree-item-title"
  >
    <k-icon :type="icon" />
    <span class="k-tree-label">
      {{ label }}
    </span>
  </k-link>
</template>

<script>
export default {
  props: {
    active: String,
    icon: String,
    id: String,
    level: Number,
    label: String,
    url: String,
  },
  computed: {
    style() {
      return {
        paddingLeft: this.level * 0.75 + "rem",
      };
    },
  },
};
</script>
