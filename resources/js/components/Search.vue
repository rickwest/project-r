<template>
<vue-autosuggest
    v-model="query"
    :suggestions="suggestions"
    @focus="focusMe"
    @click="clickHandler"
    @input="onInputChange"
    @selected="onSelected"
    :get-suggestion-value="getSuggestionValue"
    :input-props="{
        id:'autosuggest__input',
        placeholder:'Search...',
        class: 'form-control header-search',
    }"
>
    <template slot-scope="{suggestion}">
        <div class="d-flex">
            <span v-if="suggestion.item.profile.avatar" class="avatar avatar-md mr-5" :style="`background-image: url(${suggestion.item.profile.avatar})`"></span>
            <span v-else-if="suggestion.item.profile.initials" class="avatar avatar-md mr-5">{{ suggestion.item.profile.initials }}</span>
            <div class="media-body">
                <h4 class="m-0">{{ suggestion.item.name }}</h4>
                <p class="text-muted mb-0">{{ suggestion.item.profile.full_name }}</p>
            </div>
        </div>
    </template>
</vue-autosuggest>
</template>

<script>
import { VueAutosuggest } from 'vue-autosuggest';

export default {
    components: { VueAutosuggest },
    data() {
        return {
            query: '',
            selected: '',
            suggestions: [
                {
                    data: []
                }
            ],
        };
    },
    methods: {
        clickHandler(item) {
            // event fired when clicking on the input
        },
        onSelected(item) {
            this.selected = item.item;
            window.location = `/${this.selected.name}`;
        },
        onInputChange(text) {
            // event fired when the input changes
            axios
                .get('/search', {params: {q: text}})
                .then(({ data }) => {
                    this.suggestions[0].data = data;
                });
        },
        /**
         * This is what the <input/> value is set to when you are selecting a suggestion.
         */
        getSuggestionValue(suggestion) {
            return suggestion.item.name;
        },
        focusMe(e) {
            console.log(e) // FocusEvent
        }
    }
};
</script>

<style lang="scss">
#autosuggest {
    width: 100%;
    display: block;

    ul {
        width: 100%;
        list-style: none;
        margin: 0;
        padding: 0.5rem 0 .5rem 0;
    }

    li {
        margin: 0 0 0 0;
        /*border-radius: 5px;*/
        padding: 0.75rem 0 0.75rem 0.75rem;
        display: flex;
        align-items: center;
        background: #ffffff;
    }
    li:hover {
        cursor: pointer;
    }

    .autosuggest__results-item--highlighted {
        background-color: rgba(70, 127, 207, 0.09);
    }

    .autosuggest__results-container {
        background-color: #ffffff;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border-radius: 5px;
        position: absolute;
        z-index: 10;
    }
}
</style>
