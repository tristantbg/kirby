<template>
  <k-form
    class="k-blueprint-inspector-form"
    :fields="fieldset"
    :value="value"
    @input="$emit('input', $event)"
    @submit="$emit('submit', $event)"
  />
</template>

<script>
export default {
  props: {
    fields: Object,
    value: Object
  },
  computed: {
    fieldset() {
      let fields = this.fields;

      Object.keys(fields).forEach(key => {
        fields[key].name = key;
        fields[key].counter = false;
      });

      return fields;
    }
  }
}
</script>

<style>
.k-blueprint-inspector-form {
  padding: 1.5rem;
}

.k-blueprint-inspector-form .k-field {
  display: grid;
  align-items: baseline;
  grid-column-gap: .75rem;
  grid-template-columns: 6rem auto;
}
.k-blueprint-inspector-form .k-field-help {
  margin-bottom: 1.5rem;
}

.k-blueprint-inspector-form .k-field-footer {
  grid-column-start: 0;
  grid-column-end: -1;
}
.k-blueprint-inspector-form .k-fieldset .k-grid {
  grid-gap: .75rem;
}
.k-blueprint-inspector-form .k-field-label {
  font-weight: var(--font-normal);
}
.k-blueprint-inspector-form .k-field-counter {
  display: none;
}
.k-blueprint-inspector-form .k-input {
  border: 1px solid var(--color-black);
  background: #3f3f46;
  border-radius: var(--rounded);
  font-size: var(--text-sm);
  color: var(--color-gray-300);
}
.k-blueprint-inspector-form .k-input[data-disabled] {
  background: none;
}

.k-blueprint-inspector-form .k-checkboxes-input li,
.k-blueprint-inspector-form .k-radio-input li {
  border-bottom: 1px solid var(--color-gray-800) !important;
}
.k-blueprint-inspector-form .k-radio-input label::before {
  box-shadow: #3f3f46 0 0 0 2px inset;
}
.k-blueprint-inspector-form .k-radio-input input:checked + label::before {
  background: var(--color-black);
  border: 2px solid var(--color-black);
}
.k-blueprint-inspector-form .k-radio-input:focus-within input:checked + label::before {
  background: var(--color-blue-400);
  border: 2px solid var(--color-blue-400);
}


.k-blueprint-inspector-form .k-checkbox-input-icon {
  border-radius: var(--rounded);
}

</style>
