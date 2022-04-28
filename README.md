# di-rosso-theme

di-rosso-theme est un thème WordPress spécialement configuré avec Tailwind.css et les fonctionnalités de base.

```bash
git clone https://github.com/dijerosso59/di-rosso-theme.git
```

## Quickstart

1. Créer un Virtual Host WordPress
2. Dans le dossier wp-content/themes, coller le dossier du di-rosso-theme

## Configuration de Tailwind

Définissez les fichiers qui seront purgé par Tailwind avec l'élément <b>content</b> dans le tailwind.config.js :

```js
module.exports = {
  content: ['**/*.php'],
  darkMode: 'class', // or 'media' or 'class'
  theme: {
    fontFamily: {
      'patrick': ['Patrick Hand', 'cursive']
    },
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
```

## Modification du CSS
Tout d'abord, assurez-vous de mettre le nom de votre thème en début de code

Ensuite, vous travaillez uniquement avec le fichier dev.css. Il suffit d'ajouter vos règles et votre css custom à l'intérieur du layer components :

```css
/*
Theme Name: Tailwind-WP
*/

@tailwind base;
@tailwind components;
@tailwind utilities;

@layer components {

  .btn {
    @apply bg-red-500 text-3xl rounded;
  }
  
  @screen md {
  
    .btn {
      @apply px-5 py-4
    }
  
  }
  
}
```
Une fois votre travaille terminé, ouvrez un terminal dans le dossier du thème et executez cette commande :

```bash
npx tailwindcss -i assets/dev.css -o style.css -w
```

Cela va analyser le comportement de TailWind de tous les fichiers configurés précédemment avec l'élément content et mettra à jour le fichier style.css à la racine du thème.
