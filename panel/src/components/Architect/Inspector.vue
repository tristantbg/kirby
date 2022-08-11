<template>
	<div :class="'k-blueprint-' + type + '-inspector'">
		<k-inspector-header :options="options">{{ label }}</k-inspector-header>
		<k-inspector-section
			v-for="(section, sectionId) in sections"
			:key="sectionId"
			:open="section.open"
			:label="section.label"
		>
			<k-inspector-form
				:fields="section.fields"
				:value="value"
				@input="onInput"
				@submit="onSubmit"
			/>
		</k-inspector-section>
	</div>
</template>

<script>
import Form from "./InspectorForm.vue";
import Header from "./InspectorHeader.vue";
import Section from "./InspectorSection.vue";

export default {
	components: {
		"k-inspector-form": Form,
		"k-inspector-header": Header,
		"k-inspector-section": Section
	},
	props: {
		api: String,
		options: String,
		sections: Object,
		label: String,
		value: Object
	},
	created() {
		this.$events.$on("keydown.cmd.s", this.onSubmit);
	},
	destroyed() {
		this.$events.$off("keydown.cmd.s", this.onSubmit);
	},
	data() {
		return {
			values: this.value
		};
	},
	watch: {
		value() {
			this.values = this.value;
		}
	},
	methods: {
		onInput(values) {
			Object.keys(values).forEach((key) => {
				this.$set(this.values, key, values[key]);
			});
		},
		async onSubmit(e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}

			await this.$api.patch(this.api, this.values);
			await this.$reload();
		}
	}
};
</script>
