export default async function (type, selected, submit) {
  return await this.$dialog("pick/" + type, {
    query: {
      selected: selected
    },
    submit: ({ value, dialog }) => {
      return submit(value, { dialog });
    }
  });
}
