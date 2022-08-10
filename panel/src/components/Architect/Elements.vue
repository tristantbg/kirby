<template>
  <k-draggable
    :element="element"
    :options="{
      forceFallback: false,
      scroll: '.k-blueprint-body',
    }"
    handle=".k-blueprint-element-header"
    @end="onSort"
  >
    <component :is="component"
      v-for="item in items"
      :key="item.id"
      :blueprint="blueprint"
      :column="column"
      :current="current === item.id"
      :field="field"
      :section="section"
      :tab="tab"
      v-bind="item"
    />
    <slot name="footer" slot="footer" />
  </k-draggable>
</template>

<script>
export default {
  inheritAttrs: false,
  props: {
    api: String,
    blueprint: Object,
    column: Object,
    component: String,
    current: String,
    element: {
      type: String,
      default: "div"
    },
    field: Object,
    items: Object,
    section: Object,
    tab: Object,
  },
  methods: {
    onSort(...args) {
      const ids = Array.from(this.$el.querySelectorAll('.' + this.component)).map(item => {
        return item.getAttribute("data-id");
      });

      this.$api.patch(this.api + "/sort", {
        ids: ids
      });
    }
  }
}
</script>
