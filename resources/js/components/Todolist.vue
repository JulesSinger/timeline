<template>
  <div id="todolist-page">
    <h1 class="text-center">Ma todolist</h1>
    {{ todolist }}
  </div>
</template>

<script setup>
import { useTodolist } from '../api/todolist.js'
import { useRoute } from 'vue-router'

const route = useRoute()
let todolist_id = route.params.id
if(!todolist_id) {
  todolist_id = 1
}

const { todolist, todos, getTodolist } = useTodolist(todolist_id)


getTodolist()

</script>