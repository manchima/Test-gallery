<template>
    <div class="col-md-4">
        <form @submit.prevent="saveTweet">
            <div class="form-group">
                <input type="text" name="name" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
</template>