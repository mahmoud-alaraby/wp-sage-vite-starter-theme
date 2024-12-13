import Guide from '@scripts/guide';
import '@styles/main.scss';
import '@scripts/AlpineJs'

const { DEV } = import.meta.env

/**
 * Enable guide in dev mode
 */
DEV && new Guide().start();

