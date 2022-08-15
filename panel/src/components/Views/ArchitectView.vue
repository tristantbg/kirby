<template>
	<k-panel class="k-architect-view">
		<nav class="k-architect-sidebar" scroll-region>
			<header class="k-architect-sidebar-header">
				<h1>Blueprints</h1>
				<k-button icon="add" @click="$dialog('blueprints/create')" />
			</header>
			<k-tree
				v-if="menu"
				:active="(blueprint || {}).id"
				:children="menu"
				class="k-architect-tree"
			/>
		</nav>
		<k-blueprint
			v-if="blueprint"
			:blueprint="blueprint"
			:column="column"
			:field="field"
			:section="section"
			:tab="blueprint.tab"
		/>
		<nav class="k-architect-inspector">
			<k-blueprint-inspector v-bind="inspector" />
		</nav>
	</k-panel>
</template>

<script>
export default {
	props: {
		blueprint: Object,
		column: Object,
		field: Object,
		inspector: Object,
		menu: Array,
		section: Object
	},
	computed: {
		dialog() {
			return this.$helper.clone(this.$store.state.dialog);
		}
	}
};
</script>

<style>
.k-architect-view {
	display: flex;
	line-height: 1;
	background: var(--color-gray-900);
	height: 100vh;
}
.k-architect-sidebar,
.k-architect-inspector {
	padding: 0.75rem 0;
	font-size: var(--text-sm);
	overflow-y: auto;
	background: #252526;
	flex-shrink: 0;
	color: var(--color-gray-500);
}
.k-architect-sidebar {
	padding: 1.125rem 0.5rem;
	width: 14rem;
}
.k-architect-sidebar-header {
	padding: 0.375rem 0.75rem 0.375rem 0.375rem;
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 0.75rem;
}
.k-architect-sidebar-header h1 {
	font-size: var(--text-sm);
	color: var(--color-gray-200);
	margin-right: 0.75rem;
}
.k-architect-inspector {
	width: 24rem;
}

.k-architect-tree .k-tree-item-title[data-active] {
	background: #3f3f46;
	border-radius: var(--rounded);
}
</style>
