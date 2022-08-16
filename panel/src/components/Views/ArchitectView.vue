<template>
	<k-inside class="k-architect-view">
		<div class="k-architect-layout">
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
		</div>
	</k-inside>
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
.k-architect-view .k-topbar .k-view {
	max-width: 100% !important;
	padding: 0 0.75rem;
}
.k-architect-view .k-panel-view {
	overflow: hidden;
}

.k-architect-layout {
	position: absolute;
	inset: 0;
	display: flex;
	line-height: 1;
	background: var(--color-white);
}

.k-architect-sidebar,
.k-architect-inspector {
	padding: 0.75rem 0;
	font-size: var(--text-sm);
	overflow-y: auto;
	flex-shrink: 0;
	background: var(--color-light);
}
.k-architect-sidebar {
	padding: 1.125rem 0.5rem;
	width: 16rem;
}
.k-architect-sidebar-header {
	padding: 0.25rem 0.75rem 0.25rem 0.375rem;
	display: flex;
	align-items: center;
	justify-content: space-between;
	margin-bottom: 0.75rem;
}
.k-architect-sidebar-header h1 {
	font-size: var(--text-sm);
	margin-right: 0.75rem;
}
.k-architect-inspector {
	width: 30rem;
}

.k-architect-tree {
	color: var(--color-gray-700);
}
.k-architect-tree .k-tree-item-title[data-active] {
	border-radius: var(--rounded);
	background: var(--color-gray-300);
	color: var(--color-black);
}
</style>
