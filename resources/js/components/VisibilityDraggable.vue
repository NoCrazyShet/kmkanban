<template>
<div class="visibility-drag row">
        <div class="col-md-6">
            <h3>Visible</h3>
            <draggable class="list-group min-height" :list="testlistVisibleNew" :options="{animation:200, group: 'visibility'}" :element="'ul'" @add="onAdd($event, true)" @change="updateVisible">
                <li class="list-group-item" v-for="(item, index) in testlistVisibleNew" :key="item.id" :data-id="item.id">
                    <div><strong>{{item.title}}</strong></div>
                    <div>{{item.quote}}</div>
                </li>
            </draggable>
        </div>
        <div class="col-md-6">
            <h4>Invisible</h4>
            <draggable class="list-group min-height" :list="testlistNotVisibleNew" :options="{animation:200, group: 'visibility'}" :element="'ul'" @add="onAdd($event, false)" @change="updateNotVisible">
                <li class="list-group-item" v-for="(item, index) in testlistNotVisibleNew" :key="item.id" :data-id="item.id">
                    <div><strong>{{item.title}}</strong></div>
                    <div>{{item.quote}}</div>
                </li>
            </draggable>
        </div>
</div>
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        props: ['testlistVisible', 'testlistNotVisible'],

        data() {
            return {
                testlistVisibleNew: this.testlistVisible,
                testlistNotVisibleNew: this.testlistNotVisible
            }
        },

        methods: {
            onAdd(event, visible) {
                let id = event.item.getAttribute('data-id');
                axios.patch('/visibility/' + id, 
                {visibility: visible}
                );
            },
            updateVisible() {
                this.testlistVisibleNew.map((testlist, index) => {
                    testlist.order = index + 1;
                })
                axios.put('/update', {
                    testlist: this.testlistVisibleNew
                }).then((response) => {
                    //success
                })
            },
            updateNotVisible() {
                this.testlistNotVisibleNew.map((testlist, index) => {
                    testlist.order = index + 1;
                })
                axios.put('/update', {
                    testlist: this.testlistNotVisibleNew
                }).then((response) => {
                    //success
                })
            }
        },

        mounted() {
        }
    }
</script>
