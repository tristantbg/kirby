<template>
  <k-field v-bind="$props">
    <k-dropdown>
      <k-input class="k-icon-field-input">
        <button type="button" @click="$refs.dropdown.toggle()">
          <k-icon :type="value" />
        </button>
      </k-input>

      <keep-alive>
        <k-dropdown-content class="k-icon-field-dropdown" ref="dropdown">
          <details class="k-icon-field-details" open>
            <summary>Kirby</summary>
            <ul class="k-icon-field-icons">
              <li v-for="icon in icons" :key="icon">
                <k-button :icon="icon" @click="submit(icon)" />
              </li>
            </ul>
          </details>
          <details class="k-icon-field-details" v-for="emojiGroup in emojis" :key="emojiGroup.id" open>
            <summary>{{ emojiGroup.name }}</summary>
            <ul class="k-icon-field-icons">
              <li v-for="emoji in emojiGroup.emojis">
                <button :title="emoji.label" type="button" @click="submit(emoji.icon)">{{ emoji.icon }}</button>
              </li>
            </ul>
          </details>
        </k-dropdown-content>
      </keep-alive>
    </k-dropdown>
  </k-field>
</template>

<script>
export default {
  props: {
    label: String,
    required: Boolean,
    value: String,
  },
  data() {
    return {
      emojis: {},
    }
  },
  computed: {
    icons() {
      const icons = [];

      Array.from(document.querySelectorAll('.k-icons symbol')).forEach(icon => {
        const id = icon.id.replace("icon-", "");

        if (id.startsWith('file-') === false) {
          icons.push(id);
        }
      });

      return icons;
    }
  },
  async created() {
    const cache = sessionStorage.getItem("emojis");

    if (!cache) {
      this.emojis = await this.$api.get("emoji");
      console.log("fetch");
      sessionStorage.setItem("emojis", JSON.stringify(this.emojis));
    } else {
      this.emojis = JSON.parse(cache);
    }
  },
  methods: {
    submit(icon) {
      this.$emit("input", icon);
      this.$refs.dropdown.close();
    }
  }
}
</script>

<style>
.k-icon-field-input {
  width: var(--field-input-height);
  height: var(--field-input-height);
}
.k-icon-field-input button {
  display: grid;
  place-items: center;
  width: var(--field-input-height);
  height: var(--field-input-height);
}
.k-icon-field-dropdown {
  width: 100%;
  height: 20rem;
  overflow-y: scroll;
}
.k-icon-field-icons {
  margin: 0 .5rem;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(2rem, 1fr));
}
.k-icon-field-icons .k-button,
.k-icon-field-icons button {
  display: grid;
  place-items: center;
  width: 100%;
  height: 2rem;
}
.k-icon-field-details summary {
  padding: .5rem .75rem;
}
</style>
