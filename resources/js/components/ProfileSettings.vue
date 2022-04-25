<template>
    <div class="profile-settings">
        <div class="avatar-ctn">
            <img src="/images/rose.svg" alt="avatar">
            <button>Modifier l'avatar</button>
        </div>
        <form class="email-ctn">
            <label for="email">Modifier votre email</label>
            <input name="email" type="text" placeholder="Votre nouvelle adresse email" autocomplete="off">
            <button>Modifier l'adresse email</button>
        </form>
        <form class="password-ctn">
            <label for="password">Modifier votre mot de passe</label>
            <input name="password" type="password" placeholder="Votre mot de passe">
            <input name="password-confirm" type="password" placeholder="Confirmer votre mot de passe">
            <button>Modifier le mot de passe</button>
        </form>
    </div>
</template>