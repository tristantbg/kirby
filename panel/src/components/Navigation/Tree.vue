<template>
	<ul class="k-tree">
		<li v-for="child in children" class="k-tree-branch" :key="child.id">
			<k-tree-folder
				v-if="child.isFolder"
				:active="active"
				:level="level"
				v-bind="child"
			/>
			<k-tree-item v-else :active="active" :level="level" v-bind="child" />
		</li>
	</ul>
</template>

<script>
export default {
	props: {
		active: String,
		children: Array,
		level: {
			type: Number,
			default: 0
		}
	}
};
</script>

<style>
.k-tree {
	line-height: 1;
}
.k-tree summary {
	position: relative;
	display: block;
	cursor: pointer;
}
.k-tree summary::before {
	position: absolute;
	top: 50%;
	left: 0.25rem;
	font-size: var(--text-xs);
	transform: translateY(-50%);
	content: "►";
}
.k-tree details[open] > summary::before {
	transform: translateY(-50%) rotate(90deg);
}

.k-tree summary:focus {
	outline: 0;
}

.k-tree-item-title,
.k-tree-folder-title {
	padding: 0.25rem 0;
	display: flex;
	width: 100%;
	align-items: center;
	margin-bottom: 0.125rem;
}

.k-tree-label {
	display: block;
	overflow: hidden;
	white-space: nowrap;
	line-height: 1.25em;
	text-overflow: ellipsis;
}

.k-tree-item-title .k-icon,
.k-tree-folder-title .k-icon {
	color: var(--color-gray-600);
	margin-left: 1.5rem;
	margin-right: 0.5rem;
	width: 1.25rem;
	text-align: center;
}
</style>
