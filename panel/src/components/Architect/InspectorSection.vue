<template>
	<details class="k-blueprint-inspector-section" :open="open">
		<summary class="k-blueprint-inspector-section-label">{{ label }}</summary>
		<div class="k-blueprint-inspector-section-body">
			<slot />
		</div>
	</details>
</template>

<script>
export default {
	props: {
		open: Boolean,
		label: String
	}
};
</script>

<style>
.k-blueprint-inspector-section-label {
	padding: 0.5rem 1.5rem;
	background: var(--color-gray-100);
}
</style>
