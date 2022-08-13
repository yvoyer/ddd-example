<?php declare(strict_types=1);

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;
use Star\DDDExample\Common\Domain\Model\Audit\AuditedBy;
use Star\DDDExample\Common\Infrastucture\Clock\Audit\UpdatedAtDateTime;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\CreateGame;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\CreateGameHandler;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\EndGame;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\EndGameHandler;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\PlayTurn;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\PlayTurnHandler;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\StartGame;
use Star\DDDExample\TicTacToe\Domain\Messaging\Command\Game\StartGameHandler;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\GameRepository;
use Star\DDDExample\TicTacToe\Domain\Model\Game\PlayerId;
use Star\DDDExample\TicTacToe\Domain\Model\Game\Position;
use Star\DDDExample\TicTacToe\Infrastructure\Persistence\InMemory\GameCollection;

/**
 * Integration tests for domain level classes.
 * Uses only CommandBus and Aggregate classes
 */
final class InMemoryContext extends FeatureContext implements Context
{
    const GAME_ID = 'GAME_ID';
    /**
     * @var callable[] Indexed by command names (simulate a CommandBus)
     */
    private array $commands = [];

    private GameRepository $games;

    public function __construct()
    {
        $this->games = new GameCollection();
        $this->commands[CreateGame::class] = new CreateGameHandler($this->games);
        $this->commands[EndGame::class] = new EndGameHandler($this->games);
        $this->commands[PlayTurn::class] = new PlayTurnHandler($this->games);
        $this->commands[StartGame::class] = new StartGameHandler($this->games);
    }

    private function dispatchCommand($command): void
    {
        $commandName = get_class($command);

        \Webmozart\Assert\Assert::keyExists(
            $this->commands,
            $commandName,
            sprintf('Command "%s" is not present in bus.', $commandName)
        );
        $this->commands[$commandName]($command);
    }

    protected function whenTheGameIsCreated(): void
    {
        $this->dispatchCommand(
            new CreateGame(
                GameId::fromString(self::GAME_ID),
                new class () implements AuditedBy {},
                UpdatedAtDateTime::fromNow()
            )
        );
    }

    protected function whenPlayersAreStartingTheGame(PlayerId $playerOne, PlayerId $playerTwo): void
    {
        $this->dispatchCommand(
            new StartGame(
                GameId::fromString(self::GAME_ID),
                $playerOne,
                $playerTwo,
                new class () implements AuditedBy {},
                UpdatedAtDateTime::fromNow()
            )
        );
    }

    protected function whenPlayerPlaysTurn(PlayerId $playerId, Position $position): void
    {
        $this->dispatchCommand(
            new PlayTurn(
                GameId::fromString(self::GAME_ID),
                $position,
                $playerId,
                UpdatedAtDateTime::fromNow()
            )
        );
    }

    protected function assertTheGameIsATie(): void
    {
        $this->assertTheGameShouldBeEnded();
    }

    protected function assertTheGameIsAWin(PlayerId $winner): void
    {
        $this->assertTheGameShouldBeEnded();
    }

    protected function assertGameIsNotStarted(): void
    {
        Assert::assertFalse($this->games->getGameWithId(GameId::fromString(self::GAME_ID))->isStarted());
    }

    protected function assertTheGameIsStarted(): void
    {
        Assert::assertTrue($this->games->getGameWithId(GameId::fromString(self::GAME_ID))->isStarted());
    }

    protected function assertTheGameShouldBeEnded(): void
    {
        Assert::assertTrue($this->games->getGameWithId(GameId::fromString(self::GAME_ID))->isEnded());
    }
}
