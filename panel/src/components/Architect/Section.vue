<template>
	<k-blueprint-element
		:current="blueprint.active === url"
		:id="id"
		:options="url"
		class="k-blueprint-section"
	>
		<k-link slot="header" :to="url">{{ label }}</k-link>
		<div v-if="hasFields" class="k-blueprint-section-body" @click.stop>
			<k-blueprint-elements
				:api="url"
				:blueprint="blueprint"
				:items="fields"
				class="k-blueprint-fields"
				component="k-blueprint-field"
				element="k-grid"
			/>
		</div>
	</k-blueprint-element>
</template>

<script>
export default {
	inheritAttrs: false,
	props: {
		blueprint: Object,
		fields: Array,
		id: String,
		label: String,
		url: String
	},
	computed: {
		hasFields() {
			return this.fields?.length > 0;
		}
	}
};
</script>

<style>
.k-blueprint-section:not(:last-of-type) {
	margin-bottom: 0.75rem;
}
.k-blueprint-section-body {
	padding: 0.75rem;
}
.k-blueprint-fields {
	grid-gap: 0.75rem;
}
</style>
