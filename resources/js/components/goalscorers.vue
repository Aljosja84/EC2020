<template>
    <tr>
        <td></td>
        <td class="form_goals" style="vertical-align: top">
            21’ Onni Valakari<br>
            66’ J. Pohjanpalo
        </td>
        <td></td>
        <td class="form_goals" style="text-align: right; vertical-align: top">
            Ferran Torres ‘7<br>
            Ferran Torres’ 14<br>
            Gerard Moreno ‘51<br>
            Fabián Ruiz ’88
        </td>
        <td></td>
    </tr>
</template>

<script>
    export default {
        name: "goalscorers",
        props: ['matchid']
    }
</script>

<style scoped>
    .form_goals {
        font-family: "Roboto", sans-serif;
        font-size: 11px;
        color: #c6c4c4;
    }
</style>
