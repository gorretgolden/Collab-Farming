<template>
  <div>
    <div
      v-for="c in count"
      :key="'table_data_' + index + '_' + c"
      class="form-row mb-2"
    >
      <div
        class="col-md"
        v-for="field in Object.keys(inputField.rows)"
        :key="'field_prev_no_' + field"
      >
        <label v-if="c == 1" style="font-size: 12px; color: #666">{{
          inputField.rows[field].name
        }}</label>

        <div
          v-if="
            !showSelect(inputField.rows[field].type)&&
            c === 1 &&
            data &&
            name === inputField.field_input_name
          "
        >
          <input
            style="margin-bottom: 1rem"
            v-for="(x, index) in data[inputField.rows[field].name]"
            :key="index"
            :type="inputField.rows[field].type"
            :value="x"
            v-show="showItem(x)"
            class="form-control"
            :name="
              inputField.field_input_name.replaceAll('.', '').trim() +
              '[' +
              inputField.rows[field].name +
              '][' +
              (count + 1 + index) +
              ']'
            "
          />
        </div>
        <div v-else-if="c === 1 && data">
          <select
            v-for="(x, index) in data[inputField.rows[field].name]"
            :name="
              inputField.field_input_name.replaceAll('.', '').trim() +
              '[' +
              inputField.rows[field].name +
              '][' +
              c +
              ']'
            "
            :key="x + 'edit' + index"
            class="form-control custom-select"
            style="width: 100%; margin-bottom: 1rem;"
            
          >
            <option :value="x"  selected>{{x}}</option>
            <option
              v-for="value in inputField.rows[field].values.split(',')"
              :value="value.trim()"
              :key="'field_table_drop_' + value + '_' + field"
            >
              {{ value.trim() }}
            </option>
          </select>
        </div>

        <div v-if="!showSelect(inputField.rows[field].type)">
          <input
            :type="inputField.rows[field].type"
            class="form-control"
            :name="
              inputField.field_input_name.replaceAll('.', '').trim() +
              '[' +
              inputField.rows[field].name +
              '][' +
              c +
              ']'
            "
          />
        </div>

        <div v-else>
          <select
            :name="
              inputField.field_input_name.replaceAll('.', '').trim() +
              '[' +
              inputField.rows[field].name +
              '][' +
              c +
              ']'
            "
            class="form-control custom-select"
            style="width: 100%"
          >
            <option value="" disabled selected>Select</option>
            <option
              v-for="value in inputField.rows[field].values.split(',')"
              :value="value.trim()"
              :key="'field_table_drop_' + value + '_' + field"
            >
              {{ value.trim() }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div class="mt-2">
      <button
        @click="addMoreField()"
        type="button"
        class="btn btn-success add-more-btn py-2 m-0"
      >
        <span class="fa fa-plus"></span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "TableInputCollect",
  mixins: [],
  props: {
    inputField: {
      required: true,
      type: Object,
    },
    index: {
      required: true,
      type: String,
    },
    data: {
      required: false,
    },
    name: {
      required: false,
    },
  },
  data() {
    return {
      count: 1,
      first_item: "",
    };
  },
  mounted() {
    console.log(this.inputField);
  },

  methods: {
    addMoreField() {
      this.count++;
    },
    showSelect(type) {
      if (type == "Dropdown" || type === "select") {
        return true;
      }

      return false;
    },

    showItem(x) {
      if (x) {
        return true;
      }
      return false;
    },
  },
};
</script>

<style scoped>
</style>
