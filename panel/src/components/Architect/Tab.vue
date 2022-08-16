<template>
	<k-blueprint-element
		:id="id"
		:current="blueprint.active === url"
		:options="url"
		:on="blueprint.tab?.url === url"
		class="k-blueprint-tab"
		element="li"
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
		url: String
	}
};
</script>

<style>
.k-blueprint-tab {
	flex-grow: 1;
}
</style>
