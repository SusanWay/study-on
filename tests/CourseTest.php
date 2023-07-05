<?php

namespace App\Tests;

use App\DataFixtures\AppFixtures;
use App\Entity\Course;

class CourseControllerTest extends AbstractTest
{
    protected function getFixtures(): array
    {
        return [AppFixtures::class];
    }

    public function urlProviderSuccessful(): \Generator
    {
        yield ['/course'];
        yield ['/course/new'];
    }

    /**
     * @dataProvider urlProviderSuccessful
     */
    public function testPageSuccessful($url): void
    {
        $client = static::getClient();
        $client->request('GET', $url);
        $this->assertResponseOk();
    }

    public function urlProviderNotFound(): \Generator
    {
        yield ['/coursenotfound'];
    }

    /**
     * @dataProvider urlProviderNotFound
     */
    public function testPageNotFound($url): void
    {
        $client = self::getClient();
        $client->request('GET', $url);
        $this->assertResponseNotFound();
    }

    //Проверка доступа ко всем страницам курсов и их редактированию
    public function testGetActionsResponseOk(): void
    {
        $client = $this->getClient();
        //получение всех курссов
        $courses = $this->getEntityManager()->getRepository(Course::class)->findAll();
        //Цикл по всем курсам
        foreach ($courses as $course) {
            // переход на страницу контента определенного курса страница курса
            $client->request('GET', '/course/' . $course->getId());
            $this->assertResponseOk();

            // переход на страницу редактирования определенного курса страница курса
            $client->request('GET', '/course/' . $course->getId() . '/edit');
            $this->assertResponseOk();
        }
    }

    //Проверка на возможность создать курс
    public function testSuccessfulCourseCreating(): void
    {
        // Проверка к доступу на страницу всех курсов
        $client = $this->getClient();
        $crawler = $client->request('GET', '/course');
        $this->assertResponseOk();

        // перех в окно добавления нового курса
        $link = $crawler->selectLink('Создать новый курс')->link();
        $crawler = $client->click($link);
        $this->assertResponseOk();

        // Заполнения формы создания курса корректными значениями
        $courseCreatingForm = $crawler->selectButton('Сохранить')->form([
            'course[character_code]' => 'cd28',
            'course[name]' => 'name',
            'course[content]' => 'content',
            'course[image]' => 'https://i.pinimg.com/originals/8a/de/fe/8adefe5af862b4f9cec286c6ee4722cb.jpg',
        ]);
        $client->submit($courseCreatingForm);

        // редирект
        $client->followRedirect();
        $this->assertResponseOk();

        // поиск созданого курса
        $course = $this->getEntityManager()->getRepository(Course::class)->findOneBy([
            'character_code' => 'cd28',
        ]);
        $crawler = $client->request('GET', '/course/' . $course->getId());
        $this->assertResponseOk();

        // сравнение данных
        //$this->assertSame($crawler->filter('.course-name')->text(), ('name'));
        //$this->assertSame($crawler->filter('.course-content')->text(), 'content');
    }

    //Проверка ошибок при создании курса
    public function testCourseFailCreating(): void
    {
        // список курсов
        $client = $this->getClient();
        $crawler = $client->request('GET', '/course');
        $this->assertResponseOk();

        // переход на окно добавления курса
        $link = $crawler->selectLink('Создать новый курс')->link();
        $crawler = $client->click($link);
        $this->assertResponseOk();

        // заполнение формы корректными значениями(кроме кода)
        $courseCreatingForm = $crawler->selectButton('Сохранить')->form([
            'course[character_code]' => '',
            'course[name]' => 'name',
            'course[content]' => 'content',
            'course[image]' => 'https://i.pinimg.com/originals/8a/de/fe/8adefe5af862b4f9cec286c6ee4722cb.jpg',
        ]);
        $client->submit($courseCreatingForm);
        $this->assertResponseCode(422);

        // сравнение текста ошибки
        $this->assertSelectorTextContains(
            '.invalid-feedback.d-block',
            'Поле не должно быть пустым!'
        );

        // заполнение формы корректными значениями(кроме кода)
        $courseCreatingForm = $crawler->selectButton('Сохранить')->form([
            'course[character_code]' => str_repeat("sometext", 64),
            'course[name]' => 'name',
            'course[content]' => 'content',
            'course[image]' => 'https://i.pinimg.com/originals/8a/de/fe/8adefe5af862b4f9cec286c6ee4722cb.jpg',
        ]);
        $client->submit($courseCreatingForm);
        $this->assertResponseCode(422);

        // сравнение текста ошибки
        $this->assertSelectorTextContains(
            '.invalid-feedback.d-block',
            'Символьный код должен быть не более 255 символов'
        );

        // заполнение формы корректными значениями(кроме названия)
        $courseCreatingForm = $crawler->selectButton('Сохранить')->form([
            'course[character_code]' => 'cd28',
            'course[name]' => '',
            'course[content]' => 'content',
            'course[image]' => 'https://i.pinimg.com/originals/8a/de/fe/8adefe5af862b4f9cec286c6ee4722cb.jpg',
        ]);
        $client->submit($courseCreatingForm);
        $this->assertResponseCode(422);

        // сравнение текста ошибки
        $this->assertSelectorTextContains(
            '.invalid-feedback.d-block',
            'Поле не должно быть пустым!'
        );

        // заполнение формы корректными значениями(кроме описания)
        $courseCreatingForm = $crawler->selectButton('Сохранить')->form([
            'course[character_code]' => 'cd28',
            'course[name]' => 'name',
            'course[content]' => str_repeat("sometext", 250),
            'course[image]' => 'https://i.pinimg.com/originals/8a/de/fe/8adefe5af862b4f9cec286c6ee4722cb.jpg',
        ]);
        $client->submit($courseCreatingForm);
        $this->assertResponseCode(422);

        // сравнение текста ошибки
        $this->assertSelectorTextContains(
            '.invalid-feedback.d-block',
            'Описание должно быть не более 1000 символов'
        );

    }

    public function testCourseSuccessfulEditing(): void
    {
        // список курсов
        $client = $this->getClient();
        $crawler = $client->request('GET', '/course');
        $this->assertResponseOk();

        // переход на первый курс
        $link = $crawler->selectLink('Подробнее')->first()->link();
        $crawler = $client->click($link);
        $this->assertResponseOk();

        // переход на окно редактирования
        $link = $crawler->selectLink('Редактировать курс')->link();
        $crawler = $client->click($link);
        $this->assertResponseOk();
        $form = $crawler->selectButton('Сохранить изменения')->form();

        // сохранение id редактируемого курса
        $courseId = $this->getEntityManager()
            ->getRepository(Course::class)
            ->findOneBy(['character_code' => $form['course[character_code]']->getValue()])->getId();

        // заполнение формы корректными значениями
        $form['course[character_code]'] = 'dc78';
        $form['course[name]'] = 'name';
        $form['course[content]'] = 'content';
        $form['course[image]'] = 'https://i.pinimg.com/originals/8a/de/fe/8adefe5af862b4f9cec286c6ee4722cb.jpg';
        $client->submit($form);

        // редирект
        $crawler = $client->followRedirect();
        $this->assertResponseOk();

        //$this->assertRouteSame('app_course_show', ['id' => $courseId]);
    }
}