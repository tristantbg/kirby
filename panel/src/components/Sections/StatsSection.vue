<template>
	<section class="k-stats-section">
		<header class="k-section-header">
			<k-headline>
				{{ label }}
			</k-headline>
		</header>
		<k-stats v-if="reports.length > 0" :reports="reports" :size="size" />
		<k-empty v-else icon="chart"> {{ empty || $t("stats.empty") }}</k-empty>
	</section>
</template>

<script>
export default {
	props: {
		label: String,
		reports: Object,
		size: String
	}
};
</script>
