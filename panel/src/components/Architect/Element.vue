<template>
	<component
		:is="element"
		:aria-current="current"
		:data-id="id"
		:data-on="on"
		:data-width="width"
		class="k-blueprint-element"
		@click.stop
		@mouseenter="hover = true"
		@mouseleave="hover = false"
	>
		<header class="k-blueprint-element-header">
			<div class="k-blueprint-element-title">
				<slot name="header"></slot>
			</div>
			<k-dropdown class="k-blueprint-element-options">
				<k-button
					:class="{ hover: hover }"
					class="k-blueprint-element-options-toggle k-icon-button"
					icon="dots"
					@click="$refs.options.toggle()"
				/>
				<k-dropdown-content ref="options" align="right" :options="options" />
			</k-dropdown>
		</header>
		<slot></slot>
	</component>
</template>

<script>
export default {
	inheritAttrs: false,
	props: {
		blueprint: Object,
		current: Boolean,
		element: {
			type: String,
			default: "div"
		},
		id: String,
		on: Boolean,
		options: String,
		width: {
			type: String,
			default: "1/1"
		}
	},
	data() {
		return {
			hover: false
		};
	}
};
</script>

<style>
.k-blueprint-element {
	position: relative;
	color: var(--color-text);
	border-radius: var(--rounded);
	transition: all 0.2s;
	background: var(--color-gray-100);
	border: 1px solid var(--color-gray-200);
}
.k-blueprint-element[aria-current="true"] {
	box-shadow: var(--color-focus) 0 0 0 1px, var(--color-focus-outline) 0 0 0 3px;
}
.k-blueprint-element[data-on]::after {
	position: absolute;
	bottom: -7px;
	left: 50%;
	content: "";
	border-top: 7px solid var(--color-light);
	border-left: 7px solid transparent;
	border-right: 7px solid transparent;
}
.k-blueprint-element-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	width: 100%;
}
.k-blueprint-element-title {
	flex-grow: 1;
	line-height: 1;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
	color: var(--color-gray-700);
}
.k-blueprint-element-title .k-link {
	display: block;
	padding: 0.425rem 0.75rem;
}
.k-blueprint-element-options-toggle {
	opacity: 0;
	height: 2rem;
}
.k-blueprint-element-options-toggle.hover {
	opacity: 1;
}
</style>
