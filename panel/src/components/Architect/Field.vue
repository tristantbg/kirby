<template>
	<k-blueprint-element
		:current="blueprint.active === url"
		:id="id"
		:options="url"
		:width="width"
		class="k-column k-blueprint-field"
	>
		<k-link slot="header" :to="url">{{ label }}</k-link>
	</k-blueprint-element>
</template>

<script>
import Element from "./Element.vue";

export default {
	components: {
		"k-blueprint-element": Element
	},
	props: {
		blueprint: Object,
		id: String,
		label: String,
		width: String,
		url: String
	}
};
</script>

<style>
.k-blueprint-field {
	background: var(--color-gray-200);
}
</style>
