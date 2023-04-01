<template>
  <div id="todolists-page" v-if="todolists">
    <h1 class="text-center">Mes todolists</h1>
    <div id="todolists-container">
      <div v-for="todolist in todolists" :key="todolist.id" class="todolist">
        <div class="todolist-title">
          <h3>{{ todolist.name }}</h3>
        </div>
        <div class="todolist-content">
          <p>{{ todolist.description }}</p>
        </div>
        <div class="todolist-actions">
          <img src="/images/delete.svg" @click="callDeleteTodolist(todolist.id)" alt="delete" class="icon"/>
          <router-link :to="{name: 'Todolist', params: { id: todolist.id }}">GO</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useTodolist } from '../api/todolist.js'

const { todolists, getTodolists, deleteTodolist } = useTodolist()

const callDeleteTodolist = (id) => {
  deleteTodolist(id)
}
getTodolists()

</script>