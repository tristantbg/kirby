<template>
	<k-blueprint-element
		:id="id"
		:current="blueprint.active === url"
		:options="url"
		:width="width"
		element="div"
		class="k-column k-blueprint-column"
	>
		<k-link slot="header" :to="url">{{ width }}</k-link>
		<div v-if="hasSections" class="k-blueprint-column-body" @click.stop>
			<k-blueprint-elements
				:api="url"
				:blueprint="blueprint"
				:items="sections"
				class="k-blueprint-sections"
				component="k-blueprint-section"
				element="div"
			/>
		</div>
	</k-blueprint-element>
</template>

<script>
export default {
	inheritAttrs: false,
	props: {
		blueprint: Object,
		id: String,
		sections: [Array, Object],
		url: String,
		width: String
	},
	computed: {
		hasSections() {
			return Object.keys(this.sections).length > 0;
		}
	}
};
</script>

<style>
.k-blueprint-element.k-blueprint-column {
	--color: var(--color-purple-400);
}
.k-blueprint-column-body {
	padding: 1.5rem;
}
</style>
