<template>
	<header class="k-blueprint-inspector-header">
		<slot />
		<k-dropdown>
			<k-button
				class="k-icon-button"
				icon="dots"
				@click="$refs.options.toggle()"
			/>
			<k-dropdown-content
				ref="options"
				align="right"
				:options="options"
				theme="light"
			/>
		</k-dropdown>
	</header>
</template>

<script>
export default {
	props: {
		options: String
	}
};
</script>

<style>
.k-blueprint-inspector-header {
	padding-left: 1.5rem;
	padding-right: 0.75rem;
	display: flex;
	align-items: center;
	justify-content: space-between;
	font-weight: var(--font-bold);
	margin-bottom: 0.75rem;
}
</style>
