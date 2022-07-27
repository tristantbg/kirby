<template>
	<section class="k-info-section">
		<k-headline class="k-info-section-headline">
			{{ label }}
		</k-headline>
		<k-box :theme="theme">
			<!-- eslint-disable-next-line vue/no-v-html -->
			<k-text v-html="text" />
		</k-box>
	</section>
</template>

<script>
export default {
	props: {
		label: String,
		text: String,
		theme: String
	}
};
</script>

<style>
.k-info-section-headline {
	margin-bottom: 0.5rem;
}
</style>
