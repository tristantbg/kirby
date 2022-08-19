<template>
	<k-field v-bind="$props" class="k-users-field">
		<template #options>
			<k-button-group class="k-field-options">
				<k-button
					v-if="more && !disabled"
					:icon="btnIcon"
					:text="btnLabel"
					class="k-field-options-button"
					@click="open"
				/>
			</k-button-group>
		</template>

		<k-collection
			v-bind="collection"
			@empty="open"
			@sort="sort"
			@sortChange="$emit('change', $event)"
		>
			<template #options="{ item }">
				<k-button
					v-if="!disabled"
					:tooltip="$t('remove')"
					icon="remove"
					@click="remove(item)"
				/>
			</template>
		</k-collection>
	</k-field>
</template>

<script>
import picker from "@/mixins/forms/picker.js";

export default {
	mixins: [picker]
};
</script>

<style>
.k-users-field[data-disabled="true"] * {
	pointer-events: all !important;
}
</style>
