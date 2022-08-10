<template>
	<div class="k-blueprint" data-scrollarea @click="$go(blueprint.url)">
		<header class="k-blueprint-toolbar">
			<h1 class="k-blueprint-toolbar-title">{{ blueprint.label }}</h1>
			<nav class="k-blueprint-toolbar-buttons" @click.stop>
				<k-dropdown>
					<k-button
						class="k-icon-button"
						icon="dots"
						@click="$refs.options.toggle()"
					/>
					<k-dropdown-content
						ref="options"
						:options="blueprint.url"
						theme="light"
						align="right"
					/>
				</k-dropdown>
			</nav>
		</header>

		<div class="k-blueprint-body">
			<section @click.stop v-if="hasTabs">
				<h2>Tabs</h2>
				<k-blueprint-elements
					:api="blueprint.url"
					:blueprint="blueprint"
					:items="blueprint.tabs"
					class="k-blueprint-tabs"
					component="k-blueprint-tab"
					element="ul"
				>
					<li slot="footer">
						<k-button
							class="k-icon-button k-blueprint-tab-add-button"
							icon="add"
							@click="$dialog(blueprint.url + '/tabs/create')"
						/>
					</li>
				</k-blueprint-elements>
			</section>

			<section v-if="hasColumns" @click.stop class="k-blueprint-layout">
				<h2>Layout</h2>
				<k-blueprint-elements
					:api="blueprint.tab.url"
					:blueprint="blueprint"
					:items="blueprint.tab.columns"
					class="k-blueprint-columns"
					component="k-blueprint-column"
					element="k-grid"
				/>
			</section>
			<section v-else-if="blueprint.tab" @click.stop>
				<h2>Select a layout to get started …</h2>

				<div class="k-blueprint-layout-templates">
					<k-grid @click.native="prefill(['1/1'])">
						<k-column width="1/1" />
					</k-grid>
					<k-grid @click.native="prefill(['1/2', '1/2'])">
						<k-column width="1/2" />
						<k-column width="1/2" />
					</k-grid>
					<k-grid @click.native="prefill(['2/3', '1/3'])">
						<k-column width="2/3" />
						<k-column width="1/3" />
					</k-grid>
					<k-grid @click.native="prefill(['1/3', '2/3'])">
						<k-column width="1/3" />
						<k-column width="2/3" />
					</k-grid>
					<k-grid @click.native="prefill(['1/3', '1/3', '1/3'])">
						<k-column width="1/3" />
						<k-column width="1/3" />
						<k-column width="1/3" />
					</k-grid>
				</div>
			</section>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		blueprint: Object
	},
	mounted() {
		const scroll = sessionStorage.getItem("scroll");
		this.$el.scrollTop = scroll;
		this.$el.addEventListener("scroll", this.onScroll);
	},
	computed: {
		hasColumns() {
			return (
				this.blueprint.tab && Object.keys(this.blueprint.tab.columns).length > 0
			);
		},
		hasTabs() {
			return this.blueprint.tabs.length > 0;
		}
	},
	methods: {
		async prefill(layout) {
			if (this.blueprint.tab) {
				await this.$api.post(this.blueprint.tab.url + "/prefill", { layout });
				await this.$reload();
			}
		},
		onScroll(e) {
			sessionStorage.setItem("scroll", e.target.scrollTop);
		}
	}
};
</script>

<style>
.k-blueprint {
	flex-grow: 1;
	font-size: var(--text-base);
	line-height: 1;
	color: var(--color-gray-500);
	display: flex;
	flex-direction: column;
	overflow-x: auto;
	background: #1d1f21;
}

.k-blueprint-toolbar {
	display: flex;
	flex-shrink: 0;
	justify-content: space-between;
	align-items: center;
	line-height: 1;
}
.k-blueprint-toolbar-title {
	font-size: var(--text-sm);
	padding: 1.5rem 3rem;
	font-weight: var(--font-bold);
	cursor: pointer;
	color: var(--color-gray-200);
}
.k-blueprint-toolbar-buttons {
	display: flex;
	flex-shrink: 0;
	align-items: center;
	padding: 0 2.25rem;
}
.k-blueprint-toolbar-button {
	display: flex;
	padding: 0.75rem;
	line-height: 1;
}
.k-blueprint-body {
	padding: 1.5rem 3rem;
	flex-grow: 1;
	display: flex;
	flex-direction: column;
	font-size: var(--text-sm);
}
.k-blueprint-body h2 {
	font-size: var(--text-sm);
	font-weight: var(--font-normal);
	color: var(--color-gray-500);
	margin-bottom: 0.75rem;
}
.k-blueprint-body section:not(:last-child) {
	margin-bottom: 3rem;
}

.k-blueprint-tabs {
	display: flex;
	gap: 0.75rem;
}
.k-blueprint-tab-add-button {
	color: var(--color-gray-600);
	border-radius: var(--rounded);
	border: 1px solid #3f3f46;
	border-radius: var(--rounded);
}

.k-blueprint-layout {
	display: flex;
	flex-direction: column;
}
.k-blueprint-columns {
	grid-gap: 0.75rem;
}

.k-icon-button {
	display: flex;
	line-height: 1;
	padding: 0.75rem;
}

.k-blueprint-layout-templates {
	display: flex;
	gap: 1.5rem;
}
.k-blueprint-layout-templates .k-grid {
	padding: 0.25rem;
	border: 1px solid #3f3f46;
	flex-grow: 1;
	grid-gap: 0.25rem;
	border-radius: var(--rounded);
	transition: all 0.2s;
	cursor: pointer;
}
.k-blueprint-layout-templates .k-grid:hover {
	border: 1px solid var(--color-purple-400);
}
.k-blueprint-layout-templates .k-column {
	height: 9rem;
	background: #2a2a2b;
}
</style>
