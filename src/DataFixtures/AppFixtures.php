<?php

namespace App\DataFixtures;


use App\Entity\Course;
use App\Entity\Lesson;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $course_1  = new Course();
        $course_1
            ->setCharCode('00a1')
            ->setName('Дизайн и UX')
            ->setContent('Графический дизайнер создаёт визуальные концепции брендов — может отрисовать логотип, разработать брендбук, сделать презентацию или макет сайта');
        $lesson = new Lesson();
        $lesson
            ->setName('Введение')
            ->setContent('После обучения вы сможете работать дизайнером в агентствах, крупных компаниях-рекламодателях или на фрилансе. Для этого вы освоите необходимые инструменты, рассмотрите возможные карьерные треки и подготовите портфолио')
            ->setLessonNumber(1);
        $course_1->addLessonsList($lesson);

        $lesson = new Lesson();
        $lesson
            ->setName('Основы работы в UX')
            ->setContent('Научитесь создавать креативный и интуитивно понятный дизайн веб- и мобильных интерфейсов')
            ->setLessonNumber(2);
        $course_1->addLessonsList($lesson);

        $lesson = new Lesson();
        $lesson
            ->setName('Чем занимается UX/UI-дизайнер')
            ->setContent('UX/UI-дизайнер думает за пользователя, анализирует его поведение и создаёт для него удобный и приятный интерфейс. Работа специалиста улучшает взаимодействие человека с продуктом и тем самым увеличивает прибыль бизнеса.')
            ->setLessonNumber(3);
        $course_1->addLessonsList($lesson);

        $course_2  = new Course();
        $course_2
            ->setCharCode('00с3')
            ->setName('Аналитика')
            ->setContent('Data Scientist с нуля до middle');

        $lesson = new Lesson();
        $lesson
            ->setName('Погружение')
            ->setContent('В первом модуле вы разберётесь, что такое аналитическое мышление, и узнаете, откуда берутся данные. Научитесь определять ключевые продуктовые метрики и создавать дашборды.')
            ->setLessonNumber(1);
        $course_2->addLessonsList($lesson);

        $lesson = new Lesson();
        $lesson
            ->setName('СSQL, Python и Big Data')
            ->setContent('Вы получите ключевые навыки специалиста в Data Science для старта в профессии и сможете искать стажировку в новой сфере уже после прохождения первой ступени.')
            ->setLessonNumber(2);
        $course_2->addLessonsList($lesson);

        $lesson = new Lesson();
        $lesson
            ->setName('Машинное обучение, Deep Learning и нейронные сети')
            ->setContent('Получите расширенные знания в профессии и научитесь работать с нейронным сетями, обучать модели и реализовывать NLP. Начнёте повышать свою квалификацию. После окончания этой ступени сможете претендовать на позицию Junior Data Scientist и совмещать учёбу с работой.')
            ->setLessonNumber(3);
        $course_2->addLessonsList($lesson);

        $course_3  = new Course();
        $course_3
            ->setCharCode('032v')
            ->setName('Тестировщик')
            ->setContent('Вы освоите язык запросов SQL и его процедурное расширение PL/SQL. Научитесь собирать, обрабатывать и предоставлять данные для анализа, сможете визуализировать информацию и поймёте, как использовать и настраивать свои базы данных для различных задач.');

        $lesson = new Lesson();
        $lesson
            ->setName('Ручное тестирование веб-приложений')
            ->setContent('Начнём с азов проведения тестирования и введения в профессию. За 8 занятий вы познакомитесь с теориями тестирования, узнаете разницу между понятиями QA и тестированием и начнёте писать тестовые сценарии и заводить баги. На практике вы будете работать с различными программными продуктами, создавать под них тестовые сценарии и заводить баги на платформе JIRA, а также тестировать API.')
            ->setLessonNumber(1);
        $course_3->addLessonsList($lesson);

        $lesson = new Lesson();
        $lesson
            ->setName('Java для тестировщиков')
            ->setContent('В этом блоке начинаем работу с Java, одним из самых популярных языков программирования. Блок состоит из 16 занятий и включает в себя изучение основ языка, работу с объектно-ориентированным программированием, сборку Java проектов и использование инструментов тестирования. Вы изучите язык программирования именно в связке с задачами тестирования. ')
            ->setLessonNumber(2);
        $course_3->addLessonsList($lesson);

        $lesson = new Lesson();
        $lesson
            ->setName('Вёрстка сайта на HTML и CSS')
            ->setContent('Научитесь верстать сайты на HTML и CSS и вносить изменения в существующую вёрстку. По итогам модуля вы сможете самостоятельно сверстать лендинг.')
            ->setLessonNumber(3);
        $course_3->addLessonsList($lesson);

        $lesson = new Lesson();
        $lesson
            ->setName('Git — система контроля версий')
            ->setContent('Каждый разработчик должен знать основы работы с системой Git, так как на данный момент это практически стандарт по управлению исходным кодом. За 3 занятия вы научитесь работать с этой системой и с сервисом GitHub, сможете публиковать свои домашние работы и уже в процессе обучения сформируете первое портфолио (работодатели часто просят показать примеры вашего кода на GitHub).')
            ->setLessonNumber(4);
        $course_3->addLessonsList($lesson);

        $manager->merge($course_1);

        $manager->merge($course_2);

        $manager->merge($course_3);

        $manager->flush();
    }
}
